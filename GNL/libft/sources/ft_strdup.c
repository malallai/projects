/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strdup.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/08 16:35:22 by malallai          #+#    #+#             */
/*   Updated: 2018/11/19 12:51:18 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <libft.h>

char	*ft_strdup(const char *src)
{
	int		size;
	char	*dest;

	if (!src)
		return (NULL);
	size = ft_strlen(src);
	if (!(dest = (char *)malloc(sizeof(*src) * (size + 1))))
		return (NULL);
	ft_strcpy(dest, src);
	return (dest);
}
