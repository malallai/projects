/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strucpy.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 19:15:19 by malallai          #+#    #+#             */
/*   Updated: 2018/11/19 19:15:19 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <libft.h>

char	*ft_strccpy(char *dst, const char *src, char c)
{
	size_t		i;
	size_t		len;

	if (!dst || !src)
		return (NULL);
	i = 0;
	len = ft_strlen(src);
	while (src[i] != c)
	{
		if (i < len)
			dst[i] = src[i];
		else
			dst[i] = '\0';
		i++;
	}
	dst[i] = '\0';
	return (dst);
}
