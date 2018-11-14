/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strncpy.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/10 13:17:47 by malallai          #+#    #+#             */
/*   Updated: 2018/11/14 15:54:23 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strncpy(char *dest, const char *src, size_t n)
{
	size_t		i;
	size_t		len;

	i = 0;
	len = ft_strlen(src);
	while (i < n)
	{
		if (i < len)
			dest[i] = src[i];
		else
			dest[i] = '\0';
		i++;
	}
	return (dest);
}
